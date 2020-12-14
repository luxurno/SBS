import React, {Component} from 'react';
import LineChart from "../../../Core/Chart/Line/LineChart.module";

export default class PressureWeatherComponent extends Component {
    constructor(props) {
        super(props);

        this.state = {
            data: {
                labels: ['A', 'B', 'C', 'D', 'E'],
                datasets: [{
                    label: 'Dataset #2',
                    data: [1, 2, 3, 4, 5],
                    backgroundColor: '#a4dbca'
                }]
            },
            title: 'Pressure',
        }
    }

    shouldComponentUpdate(nextProps, nextState) {
        if (nextProps.data?.response !== null) {
            this.setState({
                data: {
                    labels: [nextProps.data.response.map((element) => {
                        return element.date
                    })],
                    datasets: [{
                        label: 'Dataset #2',
                        data: [nextProps.data.response.map((element) => {
                            return element['value'] = element.pressure;
                        })],
                        backgroundColor: '#a4dbca'
                    }]
                }
            });

            return true;
        }

        return false;
    }

    render() {
        return(
            <div className={'component-weather-item'}>
                <LineChart
                    data={this.state.data}
                    title={this.state.title}
                    color="#70CAD1"
                />
            </div>
        );
    }
}
