<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LocationSelector extends Component
{
    public $countries;
public $selectedCountry;

public $departments;
public $selectedDepartment;

public $cities;
public $selectedCity;
public function mount()
{
    $this->countries = Country::all();
}
    public function render()
    {
        $countries = Country::all();

    return view('livewire.location-selector', [
        'countries' => $countries,
    ]);
    }

    public function updatedSelectedCountry($value)
{
    $this->departments = Department::where('country_id', $value)->get();
    $this->cities = City::where('department_id', $value)->get();

}
}
