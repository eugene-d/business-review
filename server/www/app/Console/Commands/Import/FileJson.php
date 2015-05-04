<?php namespace App\Console\Commands\Import;

use Illuminate\Support\Facades\File;

class FileJson extends Common {
    private $filePath;
    private $fixFields;

    public function __construct() {
        parent::__construct();
        $this->fixFields = new FixFields();
    }

    /**
     * Run import process from json file
     * @param $importObject
     */
    public function run($importObject) {
        $this->filePath = $importObject->argument('filePath');
        $jsonBranches = $this->getJson();
        $jsonBranchesSize = sizeof($jsonBranches);

        foreach ($jsonBranches as $key => $branchData) {
            $this->info('Import record - ' . (++$key) . ' of ' . $jsonBranchesSize);
            $branchData = (array)$branchData;
            $branchData = $this->fixFields->createdAt($branchData);
            $branchData = $this->fixFields->us($branchData);
            $branchData = $this->fixFields->us($branchData, 'description');
            $branchData = $this->fixFields->request($branchData);

            $importObject->post($branchData);
        }
    }

    /**
     * Open file and retrieve json content
     * @return mixed|null
     */
    private function getJson() {
        $json = null;

        if (File::exists($this->filePath) AND File::isFile($this->filePath)) {
            $this->info('Getting data from: ' . $this->filePath);
            $json = $this->parseJson(File::get($this->filePath));
        } else {
            $this->error("Can't open: " . $this->filePath);
        }
        return (array)$json;
    }

    /**
     * Decode json string into json object with ability to see parsing errors
     * @param $jsonString
     * @return mixed
     */
    private function parseJson($jsonString) {
        $jsonString = trim($jsonString);
        $jsonObject = json_decode($jsonString);

        switch (json_last_error()) {
            case JSON_ERROR_NONE:
                break;
            case JSON_ERROR_DEPTH:
                $this->error('JSON_ERROR: The maximum stack depth has been exceeded');
                break;
            case JSON_ERROR_STATE_MISMATCH:
                $this->error('JSON_ERROR: Invalid or malformed JSON');
                break;
            case JSON_ERROR_CTRL_CHAR:
                $this->error('JSON_ERROR: Unexpected control character found');
                break;
            case JSON_ERROR_SYNTAX:
                $this->error('JSON_ERROR: Syntax error, malformed JSON');
                break;
            case JSON_ERROR_UTF8:
                $this->error('JSON_ERROR: Malformed UTF-8 characters, possibly incorrectly encoded');
                break;
            default:
                $this->error('JSON_ERROR: Unknown error');
                break;
        }
        return $jsonObject;
    }
}