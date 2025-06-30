@extends('layouts.master')

@section('title', 'Preview Surat PDF')

@section('content')
<main>
    <div class="container-fluid px-4">
        <div class="card p-4 mt-4">
            <h2 class="mb-4">Preview Surat PDF</h2>
            <iframe src="{{ $pdfPath }}" width="100%" height="800px"></iframe>
        </div>
    </div>
</main>
@endsection
