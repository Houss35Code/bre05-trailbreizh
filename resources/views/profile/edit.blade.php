<x-app-layout>
    <x-slot name="header">
        <h2 class="profile-header-title">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="profile-page">
        <div class="profile-page-inner">
            <div class="profile-card">
                <div class="profile-card-content">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="profile-card">
                <div class="profile-card-content">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="profile-card">
                <div class="profile-card-content">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

