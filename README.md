# EnvWriter
Laravel package to modify .env file.

## **Installation:**

From your command line run: 

*composer require gadixsystem/envwriter*

**Register the provider**

In config/app.php add the follow line:
```
 'providers' => [
       
        //EnvWriter
        gadixsystem\envwriter\EnvWriterServiceProvider::class,
  ]
  ```
  
  ## **Basic usage**
  
  In your controller add the usage statement:
  
  ```
  use gadixsystem\envwriter\EnvWriter as Envwriter;
  ```
  
  ### **Methods**
  
  * **EnvWriter::change($key,$value,$trim)**
  
  Change the value of a key, if the key does not exist EnvWriter will create a new key with this value, returns true or false.
  $trim by default is TRUE, if you need to set string with spaces use $trim = FALSE
  
  
  * **EnvWriter::exists($key)**
  
  Check if key exists or not, returns true or false.
  
  
  * **EnvWriter::delete($key)**
  
  Delete specific key, if the key does not exist it returns false
  
  **Testing**
  
  Run:
  ```
  vendor/bin/phpunit vendor/gadixsystem/envwriter/src/tests
  ```
  
