<x-app-layout>  
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Categories') }}
        </h2>
    </x-slot>  
     <div class="container">
         <h1>Categories</h1>
         <ul>
             @foreach ($categories as $category)
                 <li>{{ $category->name }}</li>
             @endforeach
         </ul>
     </div>
</x-app-layout>