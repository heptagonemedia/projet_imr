################################################################################
# Automatically-generated file. Do not edit!
################################################################################

# Add inputs and outputs from these tool invocations to the build variables 
CPP_SRCS += \
../src/Calculateur.cpp \
../src/CalculateurProjetIMR.cpp \
../src/EcritureXML.cpp \
../src/LectureXML.cpp 

OBJS += \
./src/Calculateur.o \
./src/CalculateurProjetIMR.o \
./src/EcritureXML.o \
./src/LectureXML.o 

CPP_DEPS += \
./src/Calculateur.d \
./src/CalculateurProjetIMR.d \
./src/EcritureXML.d \
./src/LectureXML.d 


# Each subdirectory must supply rules for building sources it contributes
src/%.o: ../src/%.cpp
	@echo 'Building file: $<'
	@echo 'Invoking: GCC C++ Compiler'
	g++ -std=c++1z -O0 -g3 -Wall -c -fmessage-length=0 -Wno-attributes -MMD -MP -MF"$(@:%.o=%.d)" -MT"$(@)" -o "$@" "$<"
	@echo 'Finished building: $<'
	@echo ' '


