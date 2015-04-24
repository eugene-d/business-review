<?php

use App\Services\BranchService;
use Mockery\MockInterface;

class BranchServiceTest extends TestCase {
    private $branchService;
    private $branches;
    private $emails;
    private $sites;
    private $phones;
    private $descriptions;
    private $locations;
    private $categories;

    public function __construct() {
        $this->branches = Mockery::mock('App\Models\Branches')->makePartial();

        $this->emails = Mockery::mock('App\Models\Branches\Emails');
        $this->sites = Mockery::mock('App\Models\Branches\Sites');
        $this->phones = Mockery::mock('App\Models\Branches\Phones');
        $this->descriptions = Mockery::mock('App\Models\Branches\Descriptions');
        $this->locations = Mockery::mock('App\Models\Branches\Locations');
        $this->categories = Mockery::mock('App\Models\Branches\Categories');

        $this->branchService = new BranchService($this->emails, $this->sites, $this->phones, $this->descriptions,
            $this->locations, $this->categories);
    }

    /**
     * Test branch creation with all relative records
     */
    public function testCreateWithAllRelatives() {
        $attributes = ['email' => 'emails', 'site' => 'sites', 'phone' => 'phones',
            'description_us' => 'descriptions', 'city_id' => 'locations', 'category_id' => 'categories'];

        $this->branches->shouldReceive('create')->once()->with($attributes)->andReturn($this->branches);
        $this->proceedCreateMocks($attributes);
        $this->branchService->create($attributes, $this->branches);
    }

    /**
     * That method start loop processes for accepted relative models
     * @param $attributes
     */
    private function proceedCreateMocks($attributes){
        foreach ($attributes as $attribute) {
            $this->{$attribute}->shouldReceive('fill')->once()->with($attributes)->andReturn($this->{$attribute});
            $this->{$attribute}->shouldReceive('branch')->once()->andReturn($this->{$attribute});
            $this->{$attribute}->shouldReceive('associate')->once()->andReturn($this->{$attribute});
            $this->{$attribute}->shouldReceive('save')->once()->andReturn($this->{$attribute});
        }
    }
}
