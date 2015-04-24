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
    private $attributes = ['email' => 'emails', 'site' => 'sites', 'phone' => 'phones',
        'description_us' => 'descriptions', 'city_id' => 'locations', 'category_id' => 'categories', 'id' => 1];

    public function setUp() {
        parent::setUp();

        $this->branches = Mockery::mock('Eloquent', 'App\Models\Branches');
        $this->createApplication()->instance('App\Models\Branches', $this->branches);

        $this->emails = Mockery::mock('App\Models\Branches\Emails');
        $this->sites = Mockery::mock('App\Models\Branches\Sites');
        $this->phones = Mockery::mock('App\Models\Branches\Phones');
        $this->descriptions = Mockery::mock('App\Models\Branches\Descriptions');
        $this->locations = Mockery::mock('App\Models\Branches\Locations');
        $this->categories = Mockery::mock('App\Models\Branches\Categories');

        $this->branchService = new BranchService($this->emails, $this->sites, $this->phones, $this->descriptions,
            $this->locations, $this->categories);
    }

    public function tearDown() {
        Mockery::close();
    }

    /**
     * Test branch creation with all relative records
     */
    public function testCreateWithAllRelatives() {
        $this->branches->makePartial()->shouldReceive('create')->once()->with($this->attributes)
            ->andReturn($this->branches);

        $this->proceedCreateMocks($this->attributes);
        $this->branchService->create($this->attributes, $this->branches);
    }

    /**
     * Test branch update with all relative records
     */
    public function testUpdateWithAllRelatives() {
        $this->branches->shouldReceive('find')->once()->with(1)->andReturn($this->branches)
            ->shouldReceive('fill')->once()->with($this->attributes)->andReturn($this->branches)
            ->shouldReceive('push')->once()->andReturn($this->branches);

        $this->setIrrelevantMethods(['getAttribute', 'hasGetMutator', 'email', 'hasOne', 'site', 'phone',
            'description', 'location', 'category',  'save', 'newQueryWithoutScopes',
            'getConnection', 'resolveConnection', 'getTable', 'newEloquentBuilder', 'getKeyName',
            'setAttribute', 'hasSetMutator', 'getDates', 'syncOriginal', 'touchOwners'
        ]);

        $this->proceedCreateMocks($this->attributes);

        $this->branchService->update($this->attributes, $this->branches);
    }

    /**
     * That method start loop processes for accepted relative models
     */
    private function proceedCreateMocks() {
        foreach ($this->attributes as $attribute) {
            if ($attribute != 1) {
                $this->{$attribute}->shouldReceive('branch')->once()->andReturn($this->{$attribute})
                    ->shouldReceive('fill')->once()->with($this->attributes)->andReturn($this->{$attribute})
                    ->shouldReceive('associate')->once()->andReturn($this->{$attribute})
                    ->shouldReceive('save')->once()->andReturn($this->{$attribute});
            }
        }
    }

    /**
     * The method is setting required but not relevant methods for mock object
     * @param $methods
     */
    private function setIrrelevantMethods($methods) {
        foreach ($methods as $method) {
            $this->branches->shouldReceive($method)->passthru();
        }
    }
}
