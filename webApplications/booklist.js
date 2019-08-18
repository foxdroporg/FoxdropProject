let alertMessageShowing = false;

// Book Class: Represents a Book
class Book {
  constructor(title, author, isbn) {
    this.title = title;
    this.author = author;
    this.isbn = isbn;
  }
}

// UI Class: Handle UI Tasks
class UI {
  static displayBooks() {
    const StoredBooks = Store.getBooks();
    const defaultBookShow = {
      title: "Den äldste",
      author: "Christopher Paolini",
      isbn: "9789163859885"
    };
    const defaultBookShow2 = {
      title: "Tempelriddaren",
      author: "Jan Guillous",
      isbn: "9113007335"
    };
    const defaultBookShow3 = {
      title: "The Rule of Thoughts",
      author: "James Dashner",
      isbn: "9780385741422"
    };
    if (StoredBooks.length == 0) {
      StoredBooks.push(defaultBookShow);
      StoredBooks.push(defaultBookShow2);
      StoredBooks.push(defaultBookShow3);
    }
    const books = StoredBooks;
    books.forEach(book => UI.addBookToList(book));
  }

  static addBookToList(book) {
    const list = document.querySelector("#book-list");

    const row = document.createElement("tr");

    row.innerHTML = `
        <td>${book.title}</td>
        <td>${book.author}</td>
        <td>${book.isbn}</td>
        <td><a href="#" id="deleteBtn" class="btn btn-danger btn-sm delete">X</a></td>
    `;

    list.appendChild(row);
  }

  static deleteBook(el) {
    if (el.classList.contains("delete")) {
      el.parentElement.parentElement.remove();
    }
  }

  static showAlert(message, className) {
    const div = document.createElement("div");
    div.className = `alert alert-${className}`;
    div.appendChild(document.createTextNode(message));

    // Real good to know. If you do not want to hard-code it into HTML
    const container = document.querySelector(".container");
    const form = document.querySelector("#book-form");
    container.insertBefore(div, form);
    // Delete message in an amount of seconds
    alertMessageShowing = true;
    setTimeout(() => {
      document.querySelector(".alert").remove();
      alertMessageShowing = false;
    }, 1000);
  }

  static clearFields() {
    document.querySelector("#title").value = "";
    document.querySelector("#author").value = "";
    document.querySelector("#isbn").value = "";
  }
}

// Store Class: Handles Storage. Cannot store objects in local storage !! Stores Strings is okay.
class Store {
  static getBooks() {
    let books;
    if (localStorage.getItem("books") === null) {
      books = [];
    } else {
      books = JSON.parse(localStorage.getItem("books"));
    }

    return books;
  }

  static addBook(book) {
    const books = Store.getBooks();

    books.push(book);

    localStorage.setItem("books", JSON.stringify(books));
  }

  static removeBook(isbn) {
    const books = Store.getBooks();

    books.forEach((book, index) => {
      if (book.isbn === isbn) {
        books.splice(index, 1);
      }
    });

    localStorage.setItem("books", JSON.stringify(books));
  }
}

// Event: Display Books
document.addEventListener("DOMContentLoaded", UI.displayBooks);

// Event: Add a Book
document.querySelector("#book-form").addEventListener("submit", e => {
  // Prevent actual submit!!
  e.preventDefault();

  // Get form values
  const title = document.querySelector("#title").value;
  const author = document.querySelector("#author").value;
  const isbn = document.querySelector("#isbn").value;

  // Validate that fields are filled
  if (title === "" || author === "" || isbn === "") {
    UI.showAlert("Please fill in all fields", "danger");
  } else {
    // Instatiate book
    const book = new Book(title, author, isbn);
    // Add Book to UI
    UI.addBookToList(book);

    // Add Book to Store
    Store.addBook(book);

    //  Show success message
    UI.showAlert("Book Added", "success");

    // Clear fields
    UI.clearFields();
  }
});

// Event: Remove a Book
document.querySelector("#book-list").addEventListener("click", e => {
  //#book-list
  UI.deleteBook(e.target);

  // Remove Book from Store
  Store.removeBook(e.target.parentElement.previousElementSibling.innerText);

  //  Show success message
  if (!alertMessageShowing) {
    UI.showAlert("Book Removed", "danger");
  }
});
