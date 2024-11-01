import React from 'react'
import { useState } from 'react'
import ProductList from './subCompo/ProductList'
import Create from './subCompo/Create'

const Dashboard = () => {

    //FOR PRODUCT SORTING
    const [url, setUrl] = useState('http://127.0.0.1:8000/api/product');

    const InitialOrder = () => setUrl('http://127.0.0.1:8000/api/product');
    const PriceOrderAsc = () => setUrl('http://127.0.0.1:8000/api/products/ascending');
    const PriceOrderDesc = () => setUrl('http://127.0.0.1:8000/api/products/descending');

    //FOR PRODUCT CREATION
    const [showCreate, setShowCreate] = useState(false);

    const toggleCreate = () => {
        setShowCreate(!showCreate);
    };

  return (
   <>
    <div>Header</div>

    <br/>

    <button onClick={toggleCreate}>Add New Product</button>

{showCreate && (
  <div className="modal">
    <div className="modal-content">
      <Create onClose={toggleCreate}/>
      <button className="close" onClick={toggleCreate}>Close</button>
    </div>
  </div>
)}



    <div>
        <h1>Product List</h1>
        <button onClick={InitialOrder}>Initial Order</button>
        <button onClick={PriceOrderAsc}>Ascending By Price</button>
        <button onClick={PriceOrderDesc} >Descending By Price</button>

        <ProductList url={url} />
        </div>


   </>
  )
}

export default Dashboard
