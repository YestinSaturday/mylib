<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System</title>
    <style>
    body { 
        font-family: Arial, sans-serif; 
        margin: 40px; 
        background: url('{{ asset('images/night.jpg') }}') no-repeat center center fixed;
        background-size: cover;
    }

    .container {
        max-width: 1000px;
        margin: 0 auto;
    }

    .header-section, .form-container {
        background: rgba(255,255,255,0.85); /* glass effect */
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.2);
        margin-bottom: 30px;
    }

    h1 {
        color: #2c3e50;
        margin-bottom: 20px;
        text-align: center;
    }

    .btn {
        background: #3498db;
        color: white;
        padding: 12px 25px;
        text-decoration: none;
        border-radius: 8px;
        display: inline-block;
        margin-top: 15px;
        font-weight: bold;
        transition: background 0.3s;
    }
    .btn:hover { background: #2980b9; }

    .book-card {
        background: rgba(255,255,255,0.85);
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.2);
        border-left: 5px solid #3498db;
        transition: transform 0.2s;
    }
    .book-card:hover { transform: translateY(-2px); }

    .book-title { font-size: 18px; font-weight: bold; color: #2c3e50; margin-bottom: 10px; }
    .book-author { color: #7f8c8d; margin-bottom: 8px; }
    .book-details { font-size: 14px; color: #34495e; }
    .book-details strong { color: #2c3e50; }

    .availability { 
        display: inline-block; 
        padding: 4px 12px; 
        border-radius: 20px; 
        font-size: 12px; 
        font-weight: bold;
        margin-top: 10px;
    }
    .available { background: #d4edda; color: #155724; }
    .unavailable { background: #f8d7da; color: #721c24; }

    .no-books {
        text-align: center;
        color: #fff;
        font-style: italic;
        margin: 60px 0;
        font-size: 18px;
        text-shadow: 1px 1px 4px rgba(0,0,0,0.7);
    }
</style>

</head>
<body>
    <div class="container">
        <div class="header-section">
            <h1>📚 Library Management System</h1>
            <a href="{{ route('library.create') }}" class="btn">➕ Add New Book</a>
        </div>
        
        @if(session('success'))
            <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #c3e6cb;">
                {{ session('success') }}
            </div>
        @endif
        
        @if($books->count() > 0)
            <div class="books-grid">
                @foreach($books as $book)
                <div class="book-card">
                    <div class="book-title">{{ $book->title }}</div>
                    <div class="book-author">by {{ $book->author }}</div>
                    <div class="book-details">
                        <strong>ISBN:</strong> {{ $book->isbn }}<br>
                        <strong>Publisher:</strong> {{ $book->publisher }}<br>
                        <strong>Year:</strong> {{ $book->publicationYear }}<br>
                        <strong>Category:</strong> {{ $book->category }}
                    </div>
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 15px;">
                        <span class="availability {{ $book->availability ? 'available' : 'unavailable' }}">
                            {{ $book->availability ? 'Available' : 'Unavailable' }}
                        </span>
                        <div class="book-actions" style="display: flex; gap: 8px;">
                            <a href="{{ route('library.show', $book) }}" class="action-btn" style="background: #3498db; color: white; padding: 6px 12px; text-decoration: none; border-radius: 4px; font-size: 12px;">👁️ View</a>
                            <a href="{{ route('library.edit', $book) }}" class="action-btn" style="background: #f39c12; color: white; padding: 6px 12px; text-decoration: none; border-radius: 4px; font-size: 12px;">✏️ Edit</a>
                            <form action="{{ route('library.destroy', $book) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this book?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="action-btn" style="background: #e74c3c; color: white; padding: 6px 12px; border: none; border-radius: 4px; font-size: 12px; cursor: pointer;">🗑️ Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="no-books">
                📖 No books found in the library. <a href="{{ route('library.create') }}" style="color: #3498db;">Add the first book</a>
            </div>
        @endif
    </div>
</body>
</html>