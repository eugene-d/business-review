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
    private $attributes = [];
    private $branch;
    private $emails;
    private $sites;
    private $phones;
    private $descriptions;
    private $locations;
    private $categories;

    public function __construct(Emails $emails, Sites $sites, Phones $phones, Descriptions $descriptions,
                                Locations $locations, Categories $categories) {
        $this->emails = $emails;
        $this->sites = $sites;
        $this->phones = $phones;
        $this->descriptions = $descriptions;
        $this->locations = $locations;
        $this->categories = $categories;
    }

    /**
     * The method create branch and set attributes including with relative tables attributes
     * @param array $attributes
     * @param Branches $branches
     * @return Branches|static
     */
    public function create(Array $attributes, Branches $branches) {
        $this->attributes = $attributes;
        $this->branch = $branches->create($this->attributes);
        $this->proceedBranchRelativeAttributes();
        return $this->branch;
    }

    /**
     * The method update branch and set attributes including with relative tables attributes
     * @param array $attributes
     * @param Branches $branches
     * @return Branches
     */
    public function update(Array $attributes, Branches $branches) {
        $this->attributes = $attributes;
        $this->branch = $branches->find($this->attributes['id'])->fill($this->attributes);
        $this->proceedBranchRelativeAttributes();
        $this->branch->push();
        return $this->branch;
    }

    /**
     * The method iterate input attributes and send them to branch relative models
     */
    private function proceedBranchRelativeAttributes() {
        foreach ($this->attributes as $attributeName => $attribute) {
            switch ($attributeName) {
                case 'email':
                    $this->saveBranchRelativeAttribute($this->emails, $this->branch->email);
                    break;
                case 'site':
                    $this->saveBranchRelativeAttribute($this->sites, $this->branch->site);
                    break;
                case 'phone':
                    $this->saveBranchRelativeAttribute($this->phones, $this->branch->phone);
                    break;
                case 'description_us':
                    $this->saveBranchRelativeAttribute($this->descriptions, $this->branch->description);
                    break;
                case 'city_id':
                    $this->saveBranchRelativeAttribute($this->locations, $this->branch->location);
                    break;
                case 'category_id':
                    $this->saveBranchRelativeAttribute($this->categories, $this->branch->category);
                    break;
            }
        }
    }

    /**
     * The method handle create/update records relative to branch
     * @param Model $relativeFromObject
     * @param $relativeFromMethod
     */
    private function saveBranchRelativeAttribute(Model $relativeFromObject, $relativeFromMethod) {
        if ($relativeFromMethod === null) {
            //fill and create branch relative records
            $relativeFromObject->fill($this->attributes)->branch()->associate($this->branch)->save();
        } else {
            //fill branch relative records for update
            $relativeFromMethod->fill($this->attributes);
        }
    }
}