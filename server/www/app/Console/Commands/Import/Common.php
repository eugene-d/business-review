<?php namespace App\Console\Commands\Import;

use Symfony\Component\Console\Output\ConsoleOutput;

class Common {
    protected $output;

    public function __construct() {
        $this->output = new ConsoleOutput();
    }

    /**
     * Write a string as information output.
     * @param  string $string
     * @return void
     */
    public function info($string) {
        $this->output->writeln("<info>$string</info>");
    }

    /**
     * Write a string as standard output.
     * @param  string $string
     * @return void
     */
    public function line($string) {
        $this->output->writeln($string);
    }

    /**
     * Write a string as comment output.
     * @param  string $string
     * @return void
     */
    public function comment($string) {
        $this->output->writeln("<comment>$string</comment>");
    }

    /**
     * Write a string as error output.
     * @param  string $string
     * @return void
     */
    public function error($string) {
        $this->output->writeln("<error>$string</error>");
    }
}