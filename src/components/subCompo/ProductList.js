// ProductList.js
import React, { useState, useEffect } from 'react';
import Delete from './Delete';

function ProductList({ url }) {
  const [products, setProducts] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  useEffect(() => {
    const fetchProducts = async () => {
      const token = localStorage.getItem('token');

      try {
        const response = await fetch(url, {
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

    fetchProducts();
  }, [url]);

  const handleDeleteSuccess = (deletedId) => {
    setProducts(products.filter(product => product.id !== deletedId));
  };

  if (loading) return <p>Loading...</p>;
  if (error) return <p>Error: {error}</p>;

  return (
    <div>
      {products.length === 0 ? (
        <p>No products available</p>
      ) : (
        products.map(product => (
          <div key={product.id}>
            <h3>{product.name}</h3>
            <ul>
              <li>Description: {product.description}</li>
              <li>Price: ${product.price}</li>
              <li>Category: {product.category}</li>
            </ul>
            <Delete productId={product.id} onDeleteSuccess={handleDeleteSuccess} />
          </div>
        ))
      )}
    </div>
  );
}

export default ProductList;
