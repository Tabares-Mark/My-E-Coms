import React, { useState, useEffect } from 'react';
import Delete from './Delete';
import Update from './Update';
import Search from './Search';

function ProductList({ url }) {
  const [products, setProducts] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);
  const [selectedProduct, setSelectedProduct] = useState(null);
  const [showUpdate, setShowUpdate] = useState(false);
  const [sortOrder, setSortOrder] = useState('initial');
  const [categories, setCategories] = useState([]);
  const [selectedCategory, setSelectedCategory] = useState('');

  const fetchProducts = async () => {
    const token = localStorage.getItem('token');
    
    let sortedUrl = url;

    if (sortOrder === 'ascending') {
      sortedUrl = 'http://127.0.0.1:8000/api/products/ascending';
    } else if (sortOrder === 'descending') {
      sortedUrl = 'http://127.0.0.1:8000/api/products/descending';
    }

    if (selectedCategory) {
      sortedUrl = `http://127.0.0.1:8000/api/products/category/${selectedCategory}`;
    }

    try {
      const response = await fetch(sortedUrl, {
        method: 'GET',
        headers: {
          'Content-Type': 'application/json',
          'Authorization': `Bearer ${token}`
        }
      });
      if (!response.ok) throw new Error('Fetching Failed');
      const data = await response.json();
      setProducts(data.data);
    } catch (error) {
      setError(error.message);
    } finally {
      setLoading(false);
    }
  };

  const fetchCategories = async () => {
    const token = localStorage.getItem('token');
    try {
      const response = await fetch('http://127.0.0.1:8000/api/products/categories', {
        method: 'GET',
        headers: {
          'Content-Type': 'application/json',
          'Authorization': `Bearer ${token}`
        }
      });
      if (!response.ok) throw new Error('Fetching Categories Failed');
      const data = await response.json();
      setCategories(data);
    } catch (error) {
      setError(error.message);
    }
  };

  useEffect(() => {
    fetchProducts();
    fetchCategories();
  }, [url, sortOrder, selectedCategory]);

  const handleSearchResults = (searchResults) => {
    setProducts(searchResults);
    setSortOrder('initial');
    setSelectedCategory('');
  };

  const handleDeleteSuccess = (deletedId) => {
    setProducts(products.filter(product => product.id !== deletedId));
  };

  const handleUpdateSuccess = () => {
    fetchProducts();
    setShowUpdate(false);
  };

  const openUpdateModal = (product) => {
    setSelectedProduct(product);
    setShowUpdate(true);
  };

  const handleSortChange = (e) => {
    setSortOrder(e.target.value);
  };

  const handleCategoryChange = (e) => {
    setSelectedCategory(e.target.value);
  };

  if (loading) return <p>Loading...</p>;
  if (error) return <p>Error: {error}</p>;

  return (
    <div>
      <h1>Product List</h1>
      
      <Search onSearchResults={handleSearchResults} />

      <label htmlFor="sortOrder">Sort By Price:</label>
      <select id="sortOrder" value={sortOrder} onChange={handleSortChange}>
        <option value="initial">Initial Order</option>
        <option value="ascending">Ascending</option>
        <option value="descending">Descending</option>
      </select>

      <label htmlFor="categoryFilter">Filter By Category:</label>
      <select id="categoryFilter" value={selectedCategory} onChange={handleCategoryChange}>
        <option value="">All Categories</option>
        {categories.map(category => (
          <option key={category.id} value={category.category}>
            {category.category}
          </option>
        ))}
      </select>

      {products.length === 0 ? (
        <p>No products available</p>
      ) : (
        products.map(product => (
          <div key={product.id}>
            <h3>{product.name}</h3>
            <ul>
              <li>Price: ${product.price}</li>
              <li>Quantity: {product.quantity}</li>
              <li>Category: {product.category}</li>
              <li>Description: {product.description}</li>
            </ul>
            <Delete productId={product.id} onDeleteSuccess={handleDeleteSuccess} />
            <button onClick={() => openUpdateModal(product)}>Update</button>
          </div>
        ))
      )}
      
      {showUpdate && selectedProduct && (
        <div className="modal">
          <div className="modal-content">
            <Update 
              product={selectedProduct} 
              onClose={() => setShowUpdate(false)} 
              onUpdateSuccess={handleUpdateSuccess} 
            />
          </div>
        </div>
      )}
    </div>
  );
}

export default ProductList;