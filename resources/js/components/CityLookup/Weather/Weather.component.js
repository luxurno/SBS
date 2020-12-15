import React, {Component} from 'react';
import TemperatureWeatherComponent from "./Temperature/TemperatureWeather.component";
import {CitiesStorageService} from "../../Core/Service/CitiesStorage.service.ts";
import HumidityWeatherComponent from "./Humidity/HumidityWeather.component";
import PressureWeatherComponent from "./Pressure/PressureWeather.component";

export default class WeatherComponent extends Component {
    citiesStorageService$ = new CitiesStorageService();

    constructor(props) {
        super(props);

        this.state = {
            city: "",
            response: null,
            makeResponse: true,
        };
    }

    async shouldComponentUpdate(nextProps, nextState) {
        if (nextProps.data.city !== this.props.data.city && this.state.makeResponse === true) {
            this.getWeatherByCity(nextProps).then(r => {
                this.setState({
                    makeResponse: true,
                });
            });

            return true;
        }

        return false;
    }

    async getWeatherByCity(nextProps) {
        if (this.citiesStorageService$.getCities().includes(nextProps.data.city)) {
            await axios.get('/api/weather/' + nextProps.data.city).then(res => {
                const response = res.data;
                this.setState({
                    city: nextProps.data.city,
                    response: response,
                    makeResponse: false,
                });
            });
        }
    }

    render() {
        let { showWeather } = this.props.data;

        return (
            <div
                className={'component-weather'}
                style={{display: showWeather ? 'block' : 'none' }}
            >
                <TemperatureWeatherComponent data={this.state} />
                <HumidityWeatherComponent data={this.state} />
                <PressureWeatherComponent data={this.state} />
            </div>
        );
    }
}
