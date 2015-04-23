<?php namespace App\Services;

use App\Models\Branches;
use App\Models\Branches\Emails;
use App\Models\Branches\Phones;
use App\Models\Branches\Sites;
use App\Models\Branches\Descriptions;
use App\Models\Branches\Locations;
use App\Models\Branches\Categories;
use Illuminate\Database\Eloquent\Model;

class BranchService {
    /**
     * The method create branch and set attributes including with relative tables attributes
     * @param array $attributes
     * @param Branches $branches
     * @return Branches|static
     */
    public function create(Array $attributes, Branches $branches) {
        $branches = $branches->create($attributes);
        $this->proceedBranchRelativeAttributes($attributes, $branches);
        return $branches;
    }

    /**
     * The method update branch and set attributes including with relative tables attributes
     * @param array $attributes
     * @param Branches $branches
     * @return Branches
     */
    public function update(Array $attributes, Branches $branches) {
        $branch = $branches->find($attributes['id'])->fill($attributes);
        $this->proceedBranchRelativeAttributes($attributes, $branch);
        $branch->push();
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
                    $this->saveBranchRelativeAttribute($attributes, $primary, new Emails(), $primary->email);
                    break;
                case 'site':
                    $this->saveBranchRelativeAttribute($attributes, $primary, new Sites(), $primary->site);
                    break;
                case 'phone':
                    $this->saveBranchRelativeAttribute($attributes, $primary, new Phones(), $primary->phone);
                    break;
                case 'description_us':
                    $this->saveBranchRelativeAttribute($attributes, $primary, new Descriptions(), $primary->description);
                    break;
                case 'city_id':
                    $this->saveBranchRelativeAttribute($attributes, $primary, new Locations(), $primary->location);
                    break;
                case 'category_id':
                    $this->saveBranchRelativeAttribute($attributes, $primary, new Categories(), $primary->category);
                    break;
            }
        }
    }

    /**
     * The method create/update attributes to branch relative model
     * @param array $attributes
     * @param Model $primary
     * @param Model $secondary
     * @param Model $relative
     */
    private function saveBranchRelativeAttribute(Array $attributes, Model $primary, Model $secondary, $relative) {
        if ($relative === null) {
            //create branch relative records
            $secondary = $secondary->fill($attributes);
            $secondary->branch()->associate($primary)->save();
        } else {
            //update branch relative methods
            $relative->fill($attributes);
        }
    }
}