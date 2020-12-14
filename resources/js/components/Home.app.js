import React from 'react';
import ReactDOM from 'react-dom';
import CityLookupComponent from "./CityLookup/CityLookup.component";

function Home() {
    return (
        <div className="container">
            <CityLookupComponent />
        </div>
    );
}

export default Home;

if (document.getElementById('root')) {
    ReactDOM.render(<Home />, document.getElementById('root'));
}
