import React from 'react';
import ReactDOM from 'react-dom';
import CityLookupComponent from "./CityLookup/CityLookup.component";

function Home() {
    return (
        <div className="container">
            <div className="row justify-content-center">
                <div className="col-md-8">
                    <CityLookupComponent />
                </div>
            </div>
        </div>
    );
}

export default Home;

if (document.getElementById('root')) {
    ReactDOM.render(<Home />, document.getElementById('root'));
}
