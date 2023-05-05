<div>
    <label for="country">Pays:</label>
    <select wire:model="selectedCountry" id="country">
        <option value="">-- Sélectionnez un pays --</option>
        @foreach ($countries as $country)
            <option value="{{ $country->id }}">{{ $country->name }}</option>
        @endforeach
    </select>
</div>
<div>
    <label for="department">Département:</label>
    <select wire:model="selectedDepartment" id="department">
        <option value="">-- Sélectionnez un département --</option>
        @foreach ($departments as $department)
            <option value="{{ $department->id }}">{{ $department->name }}</option>
        @endforeach
    </select>
</div>
<div>
    <label for="city">Ville:</label>
    <select wire:model="selectedCity" id="city">
        <option value="">-- Sélectionnez une ville --</option>
        @foreach ($cities as $city)
            <option value="{{ $city->id }}">{{ $city->name }}</option>
        @endforeach
    </select>
</div>
