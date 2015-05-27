<?php namespace App\Console\Commands\Import;

use Carbon\Carbon;
use URLify;

class FixFields extends Common {
    /**
     * Try to add created_at field
     * @param $in
     * @return array
     */
    public function createdAt($in) {
        if (!array_key_exists('created_at', $in)) {
            $this->comment('Field created_at not detected try to fix it.');
            $in = array_merge($in, ['created_at' => Carbon::now()->toDateTimeString()]);
        }
        return $in;
    }

    /**
     * Try to add lang dependent field
     * @param $in
     * @param string $field
     * @return array
     */
    public function us($in, $field = 'name') {
        if (!array_key_exists($field . '_us', $in)) {
            $this->comment('Field ' . $field . '_us not detected try to fix it.');
            if(array_key_exists($field . '_ua', $in)) {
                $in = array_merge($in, [$field . '_us' => URLify::downcode($in[$field . '_ua'], 'uk')]);
            } elseif (array_key_exists('name_ru', $in)) {
                $in = array_merge($in, [$field . '_us' => URLify::downcode($in[$field . '_ru'], 'ru')]);
            }
        }
        return $in;
    }

    /**
     * Try to add request field
     * @param $in
     * @return array
     */
    public function request($in) {
        if (!array_key_exists('request', $in) AND array_key_exists('name_us', $in)) {
            $this->comment('Field request not detected try to fix it.');
            $in = array_merge($in, ['request' => URLify::filter($in['name_us'])]);
        }
        return $in;
    }
}