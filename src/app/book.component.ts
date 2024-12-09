import { Component, OnInit } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { API_URL } from './app.config';  
import { environment } from './environments/environment';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

@Component({
  selector: 'app-book',
  standalone: true,
  templateUrl: './book.component.html',
  styleUrls: ['./app.component.css'],
  imports: [CommonModule, FormsModule],
})
export class BookComponent implements OnInit {
  books: any[] = [];
  newBook = { id: null, author: '', title: '', address: '', desriptions: '' };

  private apiToken = environment.apiToken;

  constructor(private http: HttpClient) {}

  ngOnInit(): void {
    this.loadBooks();
  }

  loadBooks(): void {
    const headers = new HttpHeaders({
      'X-CSRF-TOKEN': this.apiToken,
      'Content-Type': 'application/json'
    });

    this.http.get<any[]>(`${API_URL}/book`, { headers }).subscribe(
      (data) => {
        this.books = data;
      },
      (error) => {
        console.error('Error loading books:', error);
      }
    );
  }

  addBook(): void {
    const headers = new HttpHeaders({
      'X-CSRF-TOKEN': this.apiToken,
      'Content-Type': 'application/json'
    });

    this.http.post(`${API_URL}/book`, this.newBook, { 
      headers, 
      withCredentials: true 
    }).subscribe(
      (response) => {
        console.log('Book added:', response);
        this.loadBooks();
        this.resetForm();
      },
      (error) => {
        console.error('Error adding book:', error);
      }
    );
  }

  updateBook(): void {
    const headers = new HttpHeaders({
      'X-CSRF-TOKEN': this.apiToken,
      'Content-Type': 'application/json'
    });

    this.http.put(`${API_URL}/book/${this.newBook.id}`, this.newBook, { 
      headers, 
      withCredentials: true 
    }).subscribe(
      (response) => {
        console.log('Book updated:', response);
        this.loadBooks();
        this.resetForm();
      },
      (error) => {
        console.error('Error updating book:', error);
      }
    );
  }

  deleteBook(id: number): void {
    const headers = new HttpHeaders({
      'X-CSRF-TOKEN': this.apiToken,
      'Content-Type': 'application/json'
    });

    this.http.delete(`${API_URL}/book/${id}`, { 
      headers, 
      withCredentials: true 
    }).subscribe(
      () => {
        this.loadBooks();
      },
      (error) => {
        console.error('Error deleting book:', error);
      }
    );
  }

  editBook(book: any): void {
    this.newBook = { ...book };
  }

  private resetForm(): void {
    this.newBook = { id: null, author: '', title: '', address: '', desriptions: '' };
  }
}
