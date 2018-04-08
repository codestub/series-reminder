export default {
    selectedSeries: state => state.series.filter(series => series.selected === true)
}