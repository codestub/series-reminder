export default {
    receiveSeries: (state, series) => state.series = series,
    toggleSelected: (state, key) => state.series[key].selected = !state.series[key].selected,
    deselectAllSeries: state => state.series.forEach(item => item.selected = false)
}