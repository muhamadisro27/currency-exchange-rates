<x-app-layout>
    <x-slot name="header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{ isset($user->id) ? 'Edit' : 'Add' }} User</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">User</li>
                </ol>
            </div>
        </div>
    </x-slot>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
                <form action="{{ route('user.save', $user->uuid) }}" method="post">
                    @csrf
                    <input type="hidden" name="type" id="type" value="{{ isset($user->id) ? 'edit' : 'create' }}">
                    <div class="row">
                        <div class="mb-3 col-md-6 col-sm-12">
                            <x-input-label id="name" value="Name" />
                            <input type="text" class="form-control name" id="name" name="name"
                                value="{{ old('name', isset($user->id) ? $user->name : null) }}" placeholder="john doe">
                            <x-error-message id="name" :messages="$errors->get('name')" />
                        </div>
                        <div class="mb-3 col-md-6 col-sm-12">
                            <x-input-label id="email" value="Email Address" />
                            <input type="email" class="form-control name" id="email" name="email"
                                value="{{ old('email', isset($user->id) ? $user->email : null) }}"
                                placeholder="john@example.com">
                            <x-error-message id="email" :messages="$errors->get('email')" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-6 col-sm-12">
                            <x-input-label id="role" value="Role" />
                            <select class="form-select form-control" id="role" name="role" aria-label="Default select example">
                                @if (!isset($user->id))   
                                <option value="">Select role</option>
                                @endif
                                @foreach ($roles as $role)
                                    @if (isset($user->id) && count($user->getRoleNames()) > 0)
                                        @if ($role->name == $user->getRoleNames()[0])
                                            <option value="{{ $role->name }}" selected>{{ $role->name }}
                                            </option>
                                        @else
                                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                                        @endif
                                    @else
                                        <option value="{{ $role->name }}" {{  old('role') == $role->name  ? 'selected' : ''}}>{{ $role->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <x-error-message id="role" :messages="$errors->get('role')"/>
                        </div>
    
                        @if (!isset($user->id))
                            <div class="mb-3 col-md-6 col-sm-12">
                                <x-input-label id="password" value="Password" />
                                <input type="password" class="form-control " id="password" name="password"
                                    value="{{ old('password', isset($user->id) ? $user->password : null) }}"
                                    placeholder="fill the password">
                                <x-error-message id="password" :messages="$errors->get('password')" />
                            </div>
                        @endif
                    </div>
    
                    <div class="mt-3 row">
                        <div class="flex-row-reverse gap-1 col-md-12 d-flex">
                            <button type="submit"
                                class="text-white btn btn-primary ml-2">{{ isset($user->id)
                                    ? 'Save
                                                                                        Changes'
                                    : 'Submit' }}</button>
                            <a href="{{ route('user.') }}"
                                class="text-white btn btn-secondary">Back</a>
                        </div>
                    </div>    

                </form>
            </div>
            <!-- /.card-body -->
        </div>

    </section>
    <!-- /.content -->
</x-app-layout>
