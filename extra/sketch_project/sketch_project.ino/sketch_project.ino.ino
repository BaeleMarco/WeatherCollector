#include <DHT.h>
#include <SFE_BMP180.h>
#include <Wire.h>
#include <MQ135.h>
#include <VirtualWire.h>

#define DHTPIN 2
#define DHTTYPE DHT11
#define RZERO 76.63
DHT dht(DHTPIN, DHTTYPE);
SFE_BMP180 pressure;

/*TRANSMITTER*/
int TX_PIN = 5;// Tell Arduino on which pin you would like to Transmit data NOTE should be a PWM Pin
int TX_ID = 3; // Transmitter ID address

int motorAnalog = A1;
int rainAnalog = A2;
int rainDigital = 3;
int windDirectionS = 9;
int windDirectionN = 10;
int windDirectionW = 11;
int windDirectionE = 12;
MQ135 mq135_sensor = MQ135(A3);

void setup() {
  Serial.begin(9600);
  vw_setup(2000);// Setup and Begin communication over the radios at 2000bps( MIN Speed is 1000bps MAX 4000bps)
  vw_set_tx_pin(TX_PIN);// Set Tx Pin
  
  pinMode(windDirectionS,INPUT_PULLUP);
  pinMode(windDirectionN,INPUT_PULLUP);
  pinMode(windDirectionW,INPUT_PULLUP);
  pinMode(windDirectionE,INPUT_PULLUP);
  
  dht.begin();
  if (pressure.begin())
    Serial.println("BMP180 init success");
  else
    Serial.println("BMP180 init fail\n\n");
}

typedef struct roverRemoteData{
  int TX_ID;
  int Temperature;
  //Can only send integers so everything after the '.' gets send seperatly
  int TemperatureDouble;
  int Humidity;
  int Pressure;
  int PressureDouble;
  int AirQuality;
  int Rain;
  int WindSpeed;
  int WindDirection;
};

void loop(){
  String temperature = String(returnTemperature());
  int temperatureSplitPos = temperature.indexOf(".");
  int temperatureLength = temperature.length();
  int temperatureBeforeDecimal = (temperature.substring(0,temperatureSplitPos)).toInt();
  int temperatureAfterDecimal = (temperature.substring(temperatureSplitPos+1,temperatureLength)).toInt();

  String pressure = String(returnPressure()*0.0295333727);
  int pressureSplitPos = pressure.indexOf(".");
  int pressureLength = pressure.length();
  int pressureBeforeDecimal = (pressure.substring(0,pressureSplitPos)).toInt();
  int pressureAfterDecimal = (pressure.substring(pressureSplitPos+1,pressureLength)).toInt();

  //Init payload
  struct roverRemoteData payload;
  //Load payload with data
  payload.TX_ID = TX_ID;
  payload.Temperature = temperatureBeforeDecimal;
  payload.TemperatureDouble = temperatureAfterDecimal;
  payload.Humidity = int(returnHumidity());
  payload.Pressure = pressureBeforeDecimal;
  payload.PressureDouble = pressureAfterDecimal;
  payload.AirQuality = int(returnAirQuality());
  payload.Rain = int(returnRain());
  payload.WindSpeed = int(returnWindspeed());
  payload.WindDirection = returnWindDirection();

  vw_send((uint8_t *)&payload, sizeof(payload)); // Send the data 
  vw_wait_tx();// Wait for all data to be sent
  
  //Wait a minute to collect more data
  delay(5000);
}

double returnTemperature(){
  char status;
  double T;
  status = pressure.startTemperature();
  if (status != 0)
  {
    delay(status);
    status = pressure.getTemperature(T);
    if(status != 0){
      return T;
    }
  }
  Serial.println("Temp failed");
}

double returnHumidity(){
  float h = dht.readHumidity();
  if (isnan(h)) {
    Serial.println("Failed to read from DHT sensor!");
    return 101.0;
  }
  return h;
}
double returnPressure()
{
  char status;
  double T,P;

  //Need temp to calculate pressure
  T = returnTemperature();
  status = pressure.startPressure(3);
  if (status != 0)
  {
    delay(status);
    status = pressure.getPressure(P, T);
    if (status != 0)
    {
      return P;
    }
    else return 101.0;
  }
  else return 101.0;
}

double returnRain(){
  if(!(digitalRead(rainDigital))){
    return (1023-analogRead(rainAnalog))/1023.0*100;
  }else{
    return 0.0;
  }
}

double returnWindspeed(){
  return analogRead(motorAnalog)/1023.0*100;
}

int returnWindDirection(){
  String direction;
  
  if(!(digitalRead(windDirectionN))){
    direction = direction + "1";
  }
  if(!(digitalRead(windDirectionS))){
    direction = direction + "2";
  }
  if(!(digitalRead(windDirectionE))){
    direction = direction + "3";
  }
  if(!(digitalRead(windDirectionW))){
    direction = direction + "4";
  }
  
  return direction.toInt();
}

double returnAirQuality()
{
    float rzero = mq135_sensor.getRZero();
    float correctedRZero = mq135_sensor.getCorrectedRZero(returnTemperature(), returnHumidity());
    float resistance = mq135_sensor.getResistance();
    float ppm = mq135_sensor.getPPM();
    float correctedPPM = mq135_sensor.getCorrectedPPM(returnTemperature(), returnHumidity());

    double procentQuality = correctedPPM / 10000;
    return procentQuality;
}
