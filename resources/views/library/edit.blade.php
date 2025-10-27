<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit {{ $book->title }} - Library Management</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            margin: 40px; 
            background: url('{{ asset('images/night.jpg') }}') no-repeat center center fixed;
            background-size: cover;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
        }

        .form-container {
            background: rgba(255,255,255,0.85);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.2);
        }

        h1 {
            color: #2c3e50;
            text-align: center;
            margin-bottom: 20px;
        }

        label { display: block; margin-bottom: 8px; font-weight: bold; color: #2c3e50; }
        input, textarea {
            width: 100%; padding: 12px; margin-bottom: 15px;
            border-radius: 6px; border: 1px solid #bdc3c7;
            font-size: 14px;
        }
        input:focus, textarea:focus {
            border-color: #3498db;
            outline: none;
            box-shadow: 0 0 5px rgba(52,152,219,0.3);
        }

        .btn {
            background: #3498db;
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
        }
        .btn:hover { background: #2980b9; }
    </style>

</head>
<body>
    <div class="container">
        <div class="back-link">
            <a href="{{ route('library.show', $book) }}">← Back to Book Details</a>
        </div>
        
        <div class="form-container">
            <h1>✏️ Edit "{{ $book->title }}"</h1>
            
            @if ($errors->any())
                <div style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #f5c6cb;">
                    <strong>Please fix the following errors:</strong>
                    <ul style="margin: 10px 0 0 20px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <form action="{{ route('library.update', $book) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label for="isbn">ISBN <span class="required">*</span></label>
                    <input type="text" id="isbn" name="isbn" value="{{ old('isbn', $book->isbn) }}" placeholder="Enter ISBN (e.g., 978-0-123456-78-9)" required>
                </div>
                
                <div class="form-group">
                    <label for="title">Book Title <span class="required">*</span></label>
                    <input type="text" id="title" name="title" value="{{ old('title', $book->title) }}" placeholder="Enter book title" required>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="author">Author <span class="required">*</span></label>
                        <input type="text" id="author" name="author" value="{{ old('author', $book->author) }}" placeholder="Enter author name" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="publisher">Publisher</label>
                        <input type="text" id="publisher" name="publisher" value="{{ old('publisher', $book->publisher) }}" placeholder="Enter publisher name">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="publicationYear">Publication Year</label>
                        <input type="number" id="publicationYear" name="publicationYear" value="{{ old('publicationYear', $book->publicationYear) }}" placeholder="e.g., 2023" min="1000" max="2025">
                    </div>
                    
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select id="category" name="category">
                            <option value="">Select Category</option>
                            <option value="Fiction" {{ old('category', $book->category) == 'Fiction' ? 'selected' : '' }}>Fiction</option>
                            <option value="Non-Fiction" {{ old('category', $book->category) == 'Non-Fiction' ? 'selected' : '' }}>Non-Fiction</option>
                            <option value="Science" {{ old('category', $book->category) == 'Science' ? 'selected' : '' }}>Science</option>
                            <option value="Technology" {{ old('category', $book->category) == 'Technology' ? 'selected' : '' }}>Technology</option>
                            <option value="History" {{ old('category', $book->category) == 'History' ? 'selected' : '' }}>History</option>
                            <option value="Biography" {{ old('category', $book->category) == 'Biography' ? 'selected' : '' }}>Biography</option>
                            <option value="Mystery" {{ old('category', $book->category) == 'Mystery' ? 'selected' : '' }}>Mystery</option>
                            <option value="Romance" {{ old('category', $book->category) == 'Romance' ? 'selected' : '' }}>Romance</option>
                            <option value="Fantasy" {{ old('category', $book->category) == 'Fantasy' ? 'selected' : '' }}>Fantasy</option>
                            <option value="Other" {{ old('category', $book->category) == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <label>Availability</label>
                    <div class="availability-group">
                        <input type="checkbox" id="availability" name="availability" value="1" {{ old('availability', $book->availability) ? 'checked' : '' }}>
                        <label for="availability">Book is available for borrowing</label>
                    </div>
                </div>
                
                <div class="form-group">
                    <button type="submit" class="btn">💾 Update Book</button>
                    <a href="{{ route('library.show', $book) }}" class="btn-info">👁️ View Book</a>
                    <a href="{{ route('library.index') }}" class="btn-secondary">❌ Cancel</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>