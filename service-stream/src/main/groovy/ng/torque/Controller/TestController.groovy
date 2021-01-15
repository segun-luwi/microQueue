package ng.torque.Controller

import io.micronaut.http.annotation.Controller
import io.micronaut.http.annotation.Get

@Controller("/test")
class TestController {

  @Get
  def index() {
    return ['Sample1', [1, 2, 2], 'Sample2']
  }
}
