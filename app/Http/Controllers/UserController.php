<?php

    namespace App\Http\Controllers;

    use App\Models\User;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Hash;

    class UserController extends Controller
    {
        /**
         * Display a listing of the resource.
         */
        public function index()
        {
            $users = User::latest()->paginate(10);
            return view ('users.index', compact('users'));
        }

        /**
         * Show the form for creating a new resource.
         */
        public function create()
        {
            return view('users.create');
        }

        /**
         * Store a newly created resource in storage.
         */
        public function store(Request $request)
        {
            $request->validate([
                'name'      => 'required|string|max:100',
                'email'     => 'required|email|unique:users,email',
                'password'  => 'required|string|min:8|confirmed',
            ]);

            User::create([
                'name'  => $request->name,
                'email' => $request->email,
                'password'  => Hash::make($request->password),
            ]);

            return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan.');
        }

        /**
         * Display the specified resource.
         */
        public function show(User $user)
        {
            return view('users.show', compact('user'));
        }

        /**
         * Show the form for editing the specified resource.
         */
        public function edit(User $user)
        {
            return view('users.edit', compact('user'));
        }

        /**
         * Update the specified resource in storage.
         */
        public function update(Request $request, User $user)
        {
            $request->validate([
                'name'      => 'required|string|max:100',
                'email'     => 'required|email|unique:users,email,'.$user->id,
                'password'  => 'nullable|string|min:8|confirmed',
            ]);

            $user->name = $request->name;
            $user->email = $request->email;

            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }

            $user->save();

            return redirect()->route('users.index')->with('success', 'User berhasil diperbarui.');
        }

        /**
         * Remove the specified resource from storage.
         */
        public function destroy(User $user)
        {
            $user->delete();
            return redirect()->route('users.index')->with('success', 'User berhasil dihapus.');
        }
    }