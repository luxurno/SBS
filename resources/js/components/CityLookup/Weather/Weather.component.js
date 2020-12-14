import React, {PureComponent} from 'react';
import TemperatureWeatherComponent from "./Temperature/TemperatureWeather.component";
import {CitiesStorageService} from "../../Core/Service/CitiesStorage.service.ts";
import HumidityWeatherComponent from "./Humidity/HumidityWeather.component";
import PressureWeatherComponent from "./Pressure/PressureWeather.component";

export default class WeatherComponent extends PureComponent {
    citiesStorageService$ = new CitiesStorageService();

    constructor(props) {
        super(props);

        this.state = {
            response: null,
        };
        this.getWeatherByCity().then(r => {});
    }

    async getWeatherByCity() {
        await axios.get('/api/weather/' + this.props.data.city).then(res => {
            const response = res.data;
            this.setState({
                response: response
            });
        });
    }

    render() {
        let { showWeather } = this.props.data;

        return (
            <div
                className={'component-weather'}
                style={{display: showWeather ? 'block' : 'none' }}
            >
                <TemperatureWeatherComponent data={this.props} response={this.state.response} />
                <HumidityWeatherComponent data={this.props} response={this.state.response} />
                <PressureWeatherComponent data={this.props} response={this.state.response} />
            </div>
        );
    }
}
