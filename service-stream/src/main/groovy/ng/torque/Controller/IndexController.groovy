package ng.torque.Controller

import io.micronaut.http.MediaType
import io.micronaut.http.annotation.Controller
import io.micronaut.http.annotation.Get

@Controller
class IndexController {

  @Get(produces = MediaType.TEXT_PLAIN)
  String index() {
    return "Hey there!!";
  }
}
