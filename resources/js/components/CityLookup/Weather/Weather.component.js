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
        };
    }

    componentDidUpdate(prevProps, prevState) {
        this.getWeatherByCity().then(r => {});
    }

    async getWeatherByCity() {
        if (this.citiesStorageService$.getCities().includes(this.props.data.city) && this.state.response === null) {
            await axios.get('/api/weather/' + this.props.data.city).then(res => {
                const response = res.data;
                this.setState({
                    city: this.props.data.city,
                    response: response,
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
