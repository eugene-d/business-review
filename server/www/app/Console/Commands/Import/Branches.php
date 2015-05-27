<?php namespace App\Console\Commands\Import;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class Branches extends Command {
    private $fileJson;

    /**
     * The console command name.
     * @var string
     */
    protected $name = 'branch:import';

    /**
     * The console command description.
     * @var string
     */
    protected $description = 'Importing branches from file.';

    /**
     * Create a new command instance.
     */
    public function __construct() {
        parent::__construct();
        $this->fileJson = new FileJson();
    }

    /**
     * Execute the console command.
     * @return mixed
     */
    public function fire() {
        switch ($this->option('fileType')) {
            case 'json':
                $this->fileJson->run($this->argument('filePath'), $this->option('baseUrl'));
                break;
            case 'csv':
                $this->info('Implementation is in progress.');
                break;
        }
    }

    /**
     * Get the console command arguments.
     * @return array
     */
    protected function getArguments() {
        return [
            ['filePath', InputArgument::REQUIRED, 'Path to file with data.'],
        ];
    }

    /**
     * Get the console command options.
     * @return array
     */
    protected function getOptions() {
        return [
            ['fileType', null, InputOption::VALUE_OPTIONAL, 'File type. [json|csv]', 'json'],
            ['baseUrl', null, InputOption::VALUE_OPTIONAL, 'API host name.', 'http://localhost'],
        ];
    }
}