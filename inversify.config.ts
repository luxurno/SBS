import { Container } from "inversify";
import {CitiesStorageService} from "./resources/js/components/Core/Service/CitiesStorage.service";

const container = new Container();

container.bind<CitiesStorageService>(CitiesStorageService).toSelf()

export { container };

console.log(container.get<CitiesStorageService>(CitiesStorageService));
