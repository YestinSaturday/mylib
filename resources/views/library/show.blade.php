<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $book->title }} - Library Management</title>
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

        .book-card {
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

        p { margin: 10px 0; color: #34495e; }
        strong { color: #2c3e50; }

        .btn {
            display: inline-block;
            margin-top: 20px;
            background: #e74c3c;
            color: white;
            padding: 10px 20px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: bold;
        }
        .btn:hover { background: #c0392b; }
    </style>

</head>
<body>
    <div class="container">
        <div class="back-link">
            <a href="{{ route('library.index') }}">← Back to Library</a>
        </div>
        
        <div class="book-detail-card">
            <h1 class="book-title">{{ $book->title }}</h1>
            <div class="book-author">by {{ $book->author }}</div>
            
            <div class="book-info">
                <div>
                    <div class="info-item">
                        <div class="info-label">ISBN</div>
                        <div class="info-value">{{ $book->isbn }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Publisher</div>
                        <div class="info-value">{{ $book->publisher ?: 'Not specified' }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Publication Year</div>
                        <div class="info-value">{{ $book->publicationYear ?: 'Not specified' }}</div>
                    </div>
                </div>
                <div>
                    <div class="info-item">
                        <div class="info-label">Category</div>
                        <div class="info-value">{{ $book->category ?: 'Not specified' }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Added to Library</div>
                        <div class="info-value">{{ $book->created_at->format('F j, Y \a\t g:i A') }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Last Updated</div>
                        <div class="info-value">{{ $book->updated_at->format('F j, Y \a\t g:i A') }}</div>
                    </div>
                </div>
            </div>
            
            <div class="availability-badge {{ $book->availability ? 'available' : 'unavailable' }}">
                {{ $book->availability ? '✅ Available for Borrowing' : '❌ Currently Unavailable' }}
            </div>
            
            <div class="action-buttons">
                <a href="{{ route('library.edit', $book) }}" class="btn btn-warning">✏️ Edit Book</a>
                <form action="{{ route('library.destroy', $book) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this book? This action cannot be undone.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">🗑️ Delete Book</button>
                </form>
                <a href="{{ route('library.index') }}" class="btn btn-secondary">📚 Back to Library</a>
            </div>
        </div>
    </div>
</body>
</html>
