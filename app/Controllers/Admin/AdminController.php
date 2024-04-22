<?php

namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\AdminModel;

class AdminController extends Controller
{
    protected $adminModel;

    public function __construct()
    {
        $this->adminModel = new AdminModel();
    }

    public function register()
    {
        // Check if form submitted
        if ($this->request->getMethod() === 'post') {
            // Validation rules
            $rules = [
                'username' => 'required|min_length[5]|max_length[50]',
                'password' => 'required|min_length[8]',
                'email' => 'required|valid_email|is_unique[admin.email]',
                'namakaryawan' => 'required',
            ];

            // Validate input
            if (!$this->validate($rules)) {
                // Return validation errors
                return $this->response->setStatusCode(400)->setJSON(['errors' => $this->validator->getErrors()]);
            }

            // Hash password
            $password = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);

            // Prepare data
            $data = [
                'username' => $this->request->getPost('username'),
                'password' => $password,
                'email' => $this->request->getPost('email'),
                'namakaryawan' => $this->request->getPost('namakaryawan'),
            ];

            // Insert data
            $this->adminModel->insert($data);

            // Return success response
            return $this->response->setStatusCode(201)->setJSON(['message' => 'User registered successfully']);
        }

        // Return validation errors if any
        return $this->response->setStatusCode(400)->setJSON(['message' => 'Validation failed']);
    }


    public function login()
    {
        // Check if form submitted
        if ($this->request->getMethod() === 'post') {
            // Get input data
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            // Check if user exists
            $user = $this->adminModel->where('email', $email)->first();
            if ($user) {
                // Verify password
                if (password_verify($password, $user['password'])) {
                    // Set session data
                    $sessionData = [
                        'user_id' => $user['id'],
                        'username' => $user['username'],
                        'email' => $user['email'],
                        'namakaryawan' => $user['namakaryawan'],
                        'logged_in' => true,
                    ];
                    session()->set($sessionData);

                    // Return success response with session data
                    return $this->response->setStatusCode(200)->setJSON(['message' => 'Login successful', 'session' => $sessionData]);
                }
            }

            // If login fails, return error response
            return $this->response->setStatusCode(401)->setJSON(['message' => 'Invalid email or password']);
        }

        // Return validation errors if any
        return $this->response->setStatusCode(400)->setJSON(['message' => 'Validation failed']);
    }

    public function logout()
    {
        // Check if user is logged in
        if (session('logged_in')) {
            // Destroy session
            session()->destroy();
            // Return success response
            return $this->response->setStatusCode(200)->setJSON(['message' => 'Logout successful']);
        }

        // If user is not logged in, return unauthorized response
        return $this->response->setStatusCode(401)->setJSON(['message' => 'User is not logged in']);
    }

    public function getProfile()
    {
        // Check if user is logged in
        if (session('logged_in')) {
            // Get user ID from session
            $userId = session('user_id');

            // Fetch user profile from database using the user ID
            $user = $this->adminModel->find($userId);

            // Check if user exists
            if ($user) {
                // Return user profile as JSON response
                return $this->response->setStatusCode(200)->setJSON(['username' => $user['username'], 'email' => $user['email'], 'namakaryawan' => $user['namakaryawan']]);
            }

            // If user does not exist, return not found response
            return $this->response->setStatusCode(404)->setJSON(['message' => 'User not found']);
        }

        // If user is not logged in, return unauthorized response
        return $this->response->setStatusCode(401)->setJSON(['message' => 'User is not logged in']);
    }
}
