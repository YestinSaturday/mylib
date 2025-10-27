# 📚 The Book Library

This is a web application that allows users to manage a collection of books including adding, viewing, updating, and deleting records.  
This system helps organize books efficiently while providing an easy-to-use interface for students, librarians, or developers.

---

## Objectives
- To develop a simple and interactive book management. 
- To demonstrate CRUD operations (Create, Read, Update, Delete) within a structured MVC framework.  
- To provide a practical system for learning web development and database integration.

---

## Features / Functionality
 **User Registration & Login** — Secure authentication for users.  
 **Book Management** — Add, edit, view, and delete books.  
 **Search Functionality** — Quickly find books by title or author.  
 **Responsive UI** — Works smoothly on both desktop and mobile devices.  
 **Database Integration** — Uses MySQL for data storage.  
 **Admin Controls** — Manage all books and user accounts.

---

##  Installation Instructions

These are the steps to set up the project:

1. **Clone the Repository**
   ```bash
   git clone <repo-url>
   ```
2. **Install Dependencies**
   ```sh
   composer install
   npm install
   ```

3. **Environment setup:**
   - cp `.env.example` .env
     ```

4. **Database setup:**
   - to create the database and update
     php artisan migrate
     ```

5. **Run the application:**
   ```sh
   php artisan serve
   npm run dev
   ```

---

## Usage

- Register a new user account or log in.
- Add new books to the system.
- View the list of books in the library.
- Edit or delete existing records.
- Search for specific books by title, author, or  category

---

## Code Snippets

### Library Management System
````php
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

````

### Library Management
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

#### Add New Boook
````php
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h1>📚 Add New Book to Library</h1>
            
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
            
            <form action="{{ route('library.store') }}" method="POST">
                @csrf
                
                <div class="form-group">
                    <label for="isbn">ISBN <span class="required">*</span></label>
                    <input type="text" id="isbn" name="isbn" placeholder="Enter ISBN (e.g., 978-0-123456-78-9)" required>
                </div>
                
                <div class="form-group">
                    <label for="title">Book Title <span class="required">*</span></label>
                    <input type="text" id="title" name="title" placeholder="Enter book title" required>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="author">Author <span class="required">*</span></label>
                        <input type="text" id="author" name="author" placeholder="Enter author name" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="publisher">Publisher</label>
                        <input type="text" id="publisher" name="publisher" placeholder="Enter publisher name">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="publicationYear">Publication Year</label>
                        <input type="number" id="publicationYear" name="publicationYear" placeholder="e.g., 2023" min="1000" max="2025">
                    </div>
                    
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select id="category" name="category">
                            <option value="">Select Category</option>
                            <option value="Fiction">Fiction</option>
                            <option value="Non-Fiction">Non-Fiction</option>
                            <option value="Science">Science</option>
                            <option value="Technology">Technology</option>
                            <option value="History">History</option>
                            <option value="Biography">Biography</option>
                            <option value="Mystery">Mystery</option>
                            <option value="Romance">Romance</option>
                            <option value="Fantasy">Fantasy</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <label>Availability</label>
                    <div class="availability-group">
                        <input type="checkbox" id="availability" name="availability" value="1" checked>
                        <label for="availability">Book is available for borrowing</label>
                    </div>
                </div>
                
                <div class="form-group">
                    <button type="submit" class="btn">💾 Add Book to Library</button>
                    <a href="{{ route('library.index') }}" class="btn-secondary">❌ Cancel</a>
                </div>
            </form>
        </div>
    </div>
 </body>
</html>


## Show Book
````php
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

### User
<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
````
#### Store new Borrow Transaction
````php
public function returnBook($transaction_id)
{
    $transaction = Transaction::findOrFail($transaction_id);
    $transaction->status = 'returned';
    $transaction->return_date = now();
    $transaction->save();

    $book = Book::find($transaction->book_id);
    if ($book) {
        $book->quantity_available += $transaction->quantity;
        $book->save();
    }

    return redirect()->route('transactions.create')->with('success', 'Book returned successfully!');
}
````
---



## Contributors

- **Gierhan Yestin F. Sabado**