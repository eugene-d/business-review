<?php namespace App\Services;

use App\Models\Branches;
use App\Models\Branches\Emails;
use App\Models\Branches\Phones;
use App\Models\Branches\Sites;
use App\Models\Branches\Descriptions;
use App\Models\Branches\Locations;
use App\Models\Branches\Categories;
use Illuminate\Database\Eloquent\Model;

class CreateBranchService {
    /**
     * The method create branch and set attributes including with relative tables attributes
     * @param array $attributes
     * @return mixed
     */
    public function create(Array $attributes, Branches $branches) {
        $branches = $branches->create($attributes);
        $this->proceedBranchRelativeAttributes($attributes, $branches);
        return $branches;
    }

    /**
     * The method iterate input attributes and send them to branch relative models
     * @param array $attributes
     * @param Model $primary
     */
    private function proceedBranchRelativeAttributes(Array $attributes, Model $primary) {
        foreach ($attributes as $attributeName => $attribute) {
            switch ($attributeName) {
                case 'email':
                    $this->saveBranchRelativeAttribute($attributes, $primary, new Emails());
                    break;
                case 'site':
                    $this->saveBranchRelativeAttribute($attributes, $primary, new Sites());
                    break;
                case 'phone':
                    $this->saveBranchRelativeAttribute($attributes, $primary, new Phones());
                    break;
                case 'description_us':
                    $this->saveBranchRelativeAttribute($attributes, $primary, new Descriptions());
                    break;
                case 'city_id':
                    $this->saveBranchRelativeAttribute($attributes, $primary, new Locations());
                    break;
                case 'category_id':
                    $this->saveBranchRelativeAttribute($attributes, $primary, new Categories());
                    break;
            }
        }
    }

    /**
     * The method save attributes to branch relative model
     * @param array $attributes
     * @param Model $primary
     * @param Model $secondary
     */
    private function saveBranchRelativeAttribute(Array $attributes, Model $primary, Model $secondary) {
        $secondary = $secondary->fill($attributes);
        $secondary->branch()->associate($primary)->save();
    }
}