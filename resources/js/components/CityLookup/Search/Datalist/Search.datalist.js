import React, {Component} from 'react';
import axios from 'axios';
import {CitiesStorageService} from "../../../Core/Service/CitiesStorage.service.ts";

export default class SearchDatalist extends Component {
    citiesStorageService$ = new CitiesStorageService();

    constructor(props) {
        super(props);

        this.state = {
            cities: null,
            refEl: null,
        };
    }

    componentDidMount() {
        this.handleGetCities().then(r => {});
    }

    async handleGetCities() {
        await axios.get( '/api/cities').then(res => {
            const cities = res.data;
            this.citiesStorageService$.saveCities(cities);
            this.setState({ cities: cities });
        });
    }

    render() {
        if (this.state.cities !== null) {
            if (this.refEl.querySelector(":last-child") === null) {
                for (let index in this.state.cities) {
                    this.refEl.insertAdjacentHTML("beforeend",
                        '<option value="' + this.state.cities[index].name + '" />'
                    );
                }
            }
        }

        return(
            <datalist id={"cities"} ref={refEl => {
                this.refEl = refEl
            }}>
            </datalist>
        );
    }
}
