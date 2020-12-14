import React, { Component } from 'react'
import Chart from "chart.js";

export default class LineChart extends Component {
    constructor(props) {
        super(props);

        this.chartRef = React.createRef();
    }

    componentDidUpdate() {
        if (this.props.data !== null && this.props.data?.response !== null) {
            this.myChart.data.labels = this.props.data.labels.map(d => d.time);
            this.myChart.data.datasets[0].data = this.props.data.datasets[0].data.map(d => d.value);
            this.myChart.update();
        }
    }

    componentDidMount() {
        this.myChart = new Chart(this.chartRef.current, {
            type: 'bar',
            options: {
                maintainAspectRatio: false,
                scales: {
                    yAxes: [{
                        stacked: true,
                        gridLines: {
                            display: true,
                            color: "rgba(255,99,132,0.2)"
                        }
                    }],
                    xAxes: [{
                        gridLines: {
                            display: false
                        }
                    }]
                }
            },
            data: {
                labels: this.props.data.labels.map(d => d.time),
                datasets: [{
                    label: this.props.title,
                    data: this.props.data.datasets[0].data.map(d => d.value),
                    fill: 'none',
                    backgroundColor: this.props.color,
                    pointRadius: 2,
                    borderColor: this.props.color,
                    borderWidth: 1,
                    lineTension: 0
                }]
            }
        });
    }

    render() {
        return (
            <div className="chart-container">
                <canvas id={"chart"} ref={this.chartRef} />
            </div>
        );
    }
}
