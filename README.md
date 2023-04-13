The project consumes the fire and ice api using the and also implements CRUD for books information.

The external api is called with https://www.anapioficeandfire.com/api/books. The url returns all books. The result is then filtered to sort books by name of book.

For the books information, an authors model is also created. A many to many relationship is defined between the author and book relation.
The authors table is populated using factories since emphasis is on the books.
