<?php namespace App\Console\Commands\Import;

use Illuminate\Support\Facades\File;
use GuzzleHttp\Exception\ClientException;

class ImageHandler extends HttpClient {
    private $imageResource;
    private $imageName;
    private $imageSaveToPath = '../../public/img/branches/tmp/';
    private $imageUrl;

    /**
     * Run process of retrieving image
     * @param $imageUrl
     * @return mixed
     */
    public function get($imageUrl) {
        $this->imageUrl = $imageUrl;

        if($this->isImageUrlCorrect()) {
            $this->retrieveImage();
        } else {
            $this->error("Can't retrieve image from: " .  $this->imageUrl);
            $this->imageName = null;
        }

        return $this->imageName;
    }

    /**
     * Retrieve image from url
     */
    private function retrieveImage() {
        $this->createImageFile();

        try {
            $this->info('Retrieve image from: ' . $this->imageUrl);
            $this->httpClient->get($this->imageUrl, ['save_to' => $this->imageResource]);
        } catch (ClientException $e) {
            File::delete($this->imageSaveToPath . $this->imageName);
            $this->error($e->getResponse());
        }
    }

    /**
     * Move image from temp to branch relative directory
     * @param $branchPath
     */
    public function save($branchPath) {
        if ($this->imageName AND $branchPath AND File::exists($this->imageSaveToPath . $this->imageName)) {
            $branchPath = $this->imageSaveToPath . '../' . trim($branchPath, '\/') . '/';
            $this->prepareSaveToPath($branchPath);
            File::move($this->imageSaveToPath . $this->imageName, $branchPath . $this->imageName);
        }
    }

    private function isImageUrlCorrect() {
        return filter_var($this->imageUrl, FILTER_VALIDATE_URL);
    }

    /**
     * Create directories to save image file if not exist
     * @param $path
     */
    private function prepareSaveToPath($path) {
        if (!File::exists($path) AND !File::isDirectory($path)) {
            File::makeDirectory($path, 0755, true);
        }
    }

    /**
     * Create empty file to store image
     */
    private function createImageFile() {
        $this->prepareSaveToPath($this->imageSaveToPath);
        $extension = pathinfo($this->imageUrl, PATHINFO_EXTENSION);
        $name = md5($this->imageUrl);
        $this->imageName = $name . '.' . $extension;
        $this->imageResource = fopen($this->imageSaveToPath . $this->imageName, 'w');
    }
}