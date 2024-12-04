<div class="flex-grow mx-4 mr-16">
    <form action="#" method="GET" class="flex">
        <input type="text" id="search-input" name="q" placeholder="Tìm kiếm..."
            class="flex-grow p-2 border rounded-l-md" onkeyup="searchBooks()">
        <button type="submit" class="bg-blue-500 text-white p-2 rounded-r-md hover:bg-blue-600 focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                <path
                    d="M11 2a9 9 0 105.64 16.11l5.63 5.63a1 1 0 001.41-1.41l-5.63-5.63A9 9 0 0011 2zm0 2a7 7 0 110 14 7 7 0 010-14z" />
            </svg>
        </button>
    </form>

    <!-- Khu vực hiển thị kết quả tìm kiếm -->
    <div id="search-results" class="mt-4 hidden max-h-80 overflow-y-auto">
        <!-- Kết quả sẽ được hiển thị ở đây -->
    </div>
</div>

<script>
    function searchBooks() {
        let query = document.getElementById('search-input').value;

        // Nếu ô tìm kiếm không trống
        if (query.length >= 1) {
            // Gửi yêu cầu AJAX đến server
            fetch(`/tim-kiem?q=${query}`)
                .then(response => response.json())
                .then(data => {
                    let results = data.books;
                    let resultsContainer = document.getElementById('search-results');
                    resultsContainer.innerHTML = ''; // Clear current results

                    if (results.length > 0) {
                        // Lặp qua từng kết quả và tạo nội dung để hiển thị
                        results.forEach(book => {
                            let bookItem = document.createElement('div');
                            bookItem.classList.add('p-2', 'border-b', 'hover:bg-gray-100');

                            bookItem.innerHTML = `
                                <a href="/sach/${book.id}" class="block flex items-center">
                                    <img src="/storage/${book.book_image}" alt="${book.book_name}" class="w-16 h-20 object-cover mr-4">
                                    <div>
                                        <h3 class="text-lg font-semibold">${book.book_name}</h3>
                                        <p class="text-sm text-gray-600">${book.author}</p>
                                        <p class="text-sm text-gray-500">${book.price} VNĐ</p>
                                    </div>
                                </a>
                            `;

                            resultsContainer.appendChild(bookItem);
                        });
                        // Hiển thị khu vực kết quả
                        resultsContainer.classList.remove('hidden');
                    } else {
                        // Ẩn khu vực kết quả nếu không có sách nào
                        resultsContainer.classList.add('hidden');
                    }
                })
                .catch(error => console.error('Error:', error));
        } else {
            // Ẩn kết quả nếu thanh tìm kiếm trống
            document.getElementById('search-results').classList.add('hidden');
        }
    }
</script>
