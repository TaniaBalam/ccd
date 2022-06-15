@extends('errors::minimal')

@section('title', __('Forbidden'))
@section('code', 'ERROR 403')
@section('message', __($exception->getMessage() ?: 'Forbidden'))


@section('image')

    <img width="400px" height="400px" src="https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/f/6e4cbc9f-f9ee-4298-863b-6c028c0a283f/df5vdj2-5ea617fd-47bf-4a36-9f28-c99da7ee9a8c.jpg?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ1cm46YXBwOjdlMGQxODg5ODIyNjQzNzNhNWYwZDQxNWVhMGQyNmUwIiwiaXNzIjoidXJuOmFwcDo3ZTBkMTg4OTgyMjY0MzczYTVmMGQ0MTVlYTBkMjZlMCIsIm9iaiI6W1t7InBhdGgiOiJcL2ZcLzZlNGNiYzlmLWY5ZWUtNDI5OC04NjNiLTZjMDI4YzBhMjgzZlwvZGY1dmRqMi01ZWE2MTdmZC00N2JmLTRhMzYtOWYyOC1jOTlkYTdlZTlhOGMuanBnIn1dXSwiYXVkIjpbInVybjpzZXJ2aWNlOmZpbGUuZG93bmxvYWQiXX0.-e3lX_mG7i9gjenGbjfMr75k-LPl4xCadLuanjNoGPE">

@endsection