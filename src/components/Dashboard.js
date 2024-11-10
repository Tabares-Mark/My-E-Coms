
import React from 'react'
import { useState } from 'react'
import ProductList from './subCompo/ProductList'
import Create from './subCompo/Create'

const Dashboard = () => {

    //FOR PRODUCT SORTING
    const [url, setUrl] = useState('http://127.0.0.1:8000/api/product');

     //FOR PRODUCT CREATION
    const [showCreate, setShowCreate] = useState(false);

    const toggleCreate = () => {
        setShowCreate(!showCreate);
    };

  return (
   <>
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
        <ProductList url={url} />
    </div>
   </>
  )
}

export default Dashboard
