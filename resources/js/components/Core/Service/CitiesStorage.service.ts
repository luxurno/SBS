export class CitiesStorageService {
    private storageKey = 'cities-list';

    saveCities(cities: Array<object>): void {
        localStorage.setItem(this.storageKey, JSON.stringify(cities));
    }

    getCities(): Array<string> {
        return JSON.parse(localStorage.getItem(this.storageKey)).map((element) => {
            return element.name;
        });
    }
}
