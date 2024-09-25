@extends('frontend.layouts.app')
@section('content')
<div class="container mt-2">
    <h1 class="text-center mb-4">URL Shortener API Documentation</h1>
    <div class="card">
        <div class="card-header">
            <h3>1. API Overview</h3>
        </div>
        <div class="card-body">
            <p>The STEADfase URL Shortener API allows you to shorten long URLs programmatically. You can send a request with the original URL and receive a shortened version of that URL.</p>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header">
            <h3>2. Endpoint</h3>
        </div>
        <div class="card-body">
            <p><strong>HTTP Method:</strong> POST</p>
            <p><strong>End Point:</strong> <code>/api/shorten-url</code></p>
            <p><strong>URL:</strong> <code>{{  url('/') }}/api/shorten-url</code></p>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header">
            <h3>3. Request Parameters</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Parameter</th>
                        <th>Type</th>
                        <th>Required</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><code>original_url</code></td>
                        <td>string</td>
                        <td>Yes</td>
                        <td>The original URL you want to shorten. Must be a valid URL.</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header">
            <h3>4. Example Request</h3>
        </div>
        <div class="card-body">
            <h5>Request:</h5>
            <pre><code>POST {{ url('/') }}/api/shorten-url
Content-Type: application/json

{
    "original_url": "https://example.com"
}</code></pre>

            <h5>Response:</h5>
            <pre><code>{
    "success": true,
    "short_url": "{{ url('/') }}/abc123",
    "long_url": "https://example.com"
}</code></pre>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header">
            <h3>5. Error Responses</h3>
        </div>
        <div class="card-body">
            <p>If the request contains errors (e.g., missing or invalid parameters), the API will respond with a status code of <strong>422 Unprocessable Entity</strong> and an error message in the response body.</p>

            <h5>Example Error Response:</h5>
            <pre><code>{
    "success": false,
    "message": "Invalid URL provided",
    "errors": {
        "original_url": [
            "The original_url field is required."
        ]
    }
}</code></pre>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header">
            <h3>6. Notes</h3>
        </div>
        <div class="card-body">
            <ul>
                <li>Make sure to send requests as JSON with the appropriate content type header (<code>Content-Type: application/json</code>).</li>
                <li>Ensure the URL is valid. Invalid URLs will return a 422 error response.</li>
            </ul>
        </div>
    </div>

</div>
@endsection