@extends('admin-layout.base')

@section('content')
    @vite('resources/css/resident/app.css')
    <div class="py-12 bg-white shadow-xl rounded-t-lg mt-5 mx-5">
        <div class="max-w-7-xl mx-auto sm:px-6 lg:px-8">
            <h3 class="mb-3 text-3xl">Household Data</h3>
            <div class="flex w-full justify-between">
                <div class=" breadcrumbs mb-3">
                    <ul>
                        <li><a href="{{ url('data') }}">Home</a></li>
                        <li><a href="{{ url('data/household') }}">Household Data</a></li>
                        <li>Edit Household</li>
                    </ul>
                </div>
            </div>
            {{-- content --}}
            <form action="{{ url('data/household/' . $household->household_id) }}" method="POST"
                class="flex flex-col space-y-4 w-full form mr-3">
                @csrf
                {!! method_field('PUT') !!}
                @if ($errors->any())
                    <div class="bg-red-100 text-red-500 p-2 rounded-lg">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="flex flex-col space-y-1">
                    <label for="resident_id">Family Head</label>
                    <select name="resident_id" id="resident_id" class="rounded-md border border-gray-300 p-2">
                        <option disabled selected value="{{ old('resident_id', $household->familyHead->resident_id) }}">- Choose
                            Family Head -</option>
                        @foreach ($familyHead as $item)
                            <option value="{{ $item->resident_id }}">{{ $item->full_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="flex flex-col space-y-1">
                    <label for="number_kk">Number KK</label>
                    <input type="number" name="number_kk" id="number_kk" class="rounded-md border border-gray-300 p-2"
                        placeholder="Enter your Number KK" maxlength="16" min="0"
                        value="{{ old('number_kk', $household->number_kk) }}">
                </div>
                <div class="flex flex-col space-y-1">
                    <label for="address">Address</label>
                    <input type="text" name="address" id="address" class="rounded-md border border-gray-300 p-2"
                        placeholder="Enter your address" value="{{ old('address', $household->address) }}">
                </div>
                <div class="flex flex-col space-y-1">
                    <label for="rt">RT</label>
                    <input type="text" name="rt" id="rt" class="rounded-md border border-gray-300 p-2"
                        placeholder="Enter your rt" value="{{ old('rt', $household->rt) }}">
                </div>
                <div class="flex flex-col space-y-1">
                    <label for="rw">RW</label>
                    <input type="text" name="rw" id="rw" class="rounded-md border border-gray-300 p-2"
                        placeholder="Enter your rw" value="{{ old('rw', $household->rw) }}">
                </div>
                <div class="flex flex-col space-y-1">
                    <label for="sub_district">Kelurahan</label>
                    <input type="text" name="sub_district" id="sub_district"
                        class="rounded-md border border-gray-300 p-2" placeholder="Enter your kelurahan"
                        value="{{ old('sub_district', $household->sub_district) }}">
                </div>
                <div class="flex flex-col space-y-1">
                    <label for="district">Kecamatan</label>
                    <input type="text" name="district" id="district" class="rounded-md border border-gray-300 p-2"
                        placeholder="Enter your kecamatan" value="{{ old('district', $household->district) }}">
                </div>
                <div class="flex flex-col space-y-1">
                    <label for="city">Kota</label>
                    <input type="text" name="city" id="city" class="rounded-md border border-gray-300 p-2"
                        placeholder="Enter your kota" value="{{ old('city', $household->city) }}">
                </div>
                <div class="flex flex-col space-y-1">
                    <label for="province">Provinsi</label>
                    <input type="text" name="province" id="province" class="rounded-md border border-gray-300 p-2"
                        placeholder="Enter your provinsi" value="{{ old('province', $household->province) }}">
                </div>
                <div class="flex flex-col space-y-1">
                    <label for="postal_code">Kode Pos</label>
                    <input type="text" name="postal_code" id="postal_code" class="rounded-md border border-gray-300 p-2"
                        placeholder="Enter your kode pos" value="{{ old('postal_code', $household->postal_code) }}">
                </div>
                <div class="flex flex-col space-y-1">
                    <label for="area">House Area</label>
                    <input type="number" name="area" id="area" class="rounded-md border border-gray-300 p-2"
                        placeholder="Enter your Household Area" value="{{ old('area', $household->area) }}">
                </div>
                <div class="flex">
                    <button type="submit"
                        class="add-btn btn-sm px-4 py-1.5 text-white rounded-md mt-5 w-1/6">Edit</button>
                    <a class="add-btn btn-sm px-4 py-1.5 text-white rounded-md mt-5 w-1/6 mx-3 text-center"
                        href="{{ url('data/household') }}">Back</a>
                </div>
            </form>
        </div>
    </div>
@endsection
