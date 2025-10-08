class Vehicle {
    public void power_Boost() {
        System.out.println("Vehicle is boosting power...");
    }
}

// Child class
public class Car extends Vehicle {
    int power = 2000;
    String model = "Nissan Almera 1.2";

    public static void powerUp() {
        for (int i = 1; i <= 10; i++) {
            System.out.println("Power level: " + i);
        }
    }

    @Override
    public void power_Boost() {
        System.out.println("Power: " + power);
        System.out.println("Model: " + model);
    }

    public static void main(String[] args) {
        Car.powerUp();
        Car pow1 = new Car();
        pow1.power_Boost();
    }
}

