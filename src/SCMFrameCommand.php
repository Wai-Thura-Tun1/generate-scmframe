<?php

namespace Generate\Scmframe;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class SCMFrameCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:scm {name*}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Auto Generated Folder For SCM Flow.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $flowname = $this->argument('name');
        foreach ($flowname as $name) {
            $filterFile = ucfirst($name);
            $this->checkCreateNeeds($filterFile, "app/Contracts/Dao");
            $this->checkCreateNeeds($filterFile, "app/Dao");
            $this->checkCreateNeeds($filterFile, "app/Contracts/Services");
            $this->checkCreateNeeds($filterFile, "app/Services");
            Artisan::call('make:model -mc ' . $filterFile . ' -mcr');
            $this->info("Model, Migration and Controller files of " . $filterFile . " are generated.");
        }
        $this->info("Successfully created files. Now ready to implement.");
    }

    private function checkCreateNeeds($filename, $folder)
    {
        $fileExtension = ".php";
        if (!is_dir($folder)) {
            mkdir($folder, 0777, true);
            $this->info($folder . " is generated.");
        }
        if (str_contains($folder, "Contracts")) {
            $fileExtension = "Interface" . $fileExtension;
            $this->determineFilename($filename, $folder, $fileExtension);
        }
        $this->determineFilename($filename, $folder, $fileExtension);
        return;
    }

    public function determineFilename($filename, $folder, $fileExtension)
    {
        $name = $folder . '/' . ucfirst($filename);
        if (str_contains($folder, "Dao")) {
            $fileExtension = "Dao" . $fileExtension;
            $content = $this->makeContent($folder, $filename, true);
            $this->createFile($name . $fileExtension, $content);
        } elseif (str_contains($folder, "Services")) {
            $fileExtension = "Service" . $fileExtension;
            $content = $this->makeContent($folder, $filename, false);
            $this->createFile($name . $fileExtension, $content);
        }
        return;
    }

    public function createFile($name, $content)
    {
        if (!file_exists($name)) {
            $newFile = fopen($name, 'w');
            fwrite(
                $newFile,
                $content
            );
            fclose($newFile);
            $this->info($name . " is generated.");
            return;
        }
        $this->info($name . " is already generated");
        return;
    }

    public function makeContent($folder, $filename, bool $dao)
    {
        $content = "";
        $splitString = explode("/", $folder);
        $useString = "";
        $namespace = "namespace" . ' ' . join(DIRECTORY_SEPARATOR, array_map(function ($b) {
            return ucfirst($b);
        }, $splitString)) . ';';
        $finalName = trim(ucfirst($filename), '.php');
        if (str_contains($folder, "Contracts")) {
            if ($dao) {
                $content = "interface " . $finalName . "DaoInterface {
}";
            } else {
                $content = "interface " . $finalName . "ServiceInterface {
}";
            }
        } else {
            $useString = "use App\Contracts";
            if ($dao) {
                $useString .= "\Dao" . DIRECTORY_SEPARATOR . "" . $filename . "DaoInterface;";
                $content = "class " . $finalName . "Dao implements " . $finalName . "DaoInterface {
}";
            } else {
                $useString .= "\Services" . DIRECTORY_SEPARATOR . "" . $filename . "ServiceInterface;";
                $content = "class " . $finalName . "Service implements " . $finalName . "ServiceInterface {
    public function __construct() {

    }
}";
            }
        }

        return "<?php
" . $namespace . PHP_EOL . $useString . PHP_EOL . $content . PHP_EOL .
            "?>";
    }

}
