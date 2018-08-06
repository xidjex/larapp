@extends('layouts.app')

@section('content')

<div id="app">

    @include('layouts.header')

    <progress-bar  :state="progress"></progress-bar>
    <apartments-list 
        :list="list"  
        :filters="search" 
        @not_found="searchError"
        @details='showDetails'>
    </apartments-list>

    <add-apartment-modal @store="_loadList()"></add-apartment-modal>

    <apartment-details-modal 
         v-if="selectedIndex != null" 
         :index="selectedIndex" 
         @close="selectedIndex = null" 
         @update="_loadList()">
    </apartment-details-modal>
</div>
    
    <script src="{{ asset('js/app.js') }}"></script>

@endsection
