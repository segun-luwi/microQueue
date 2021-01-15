#/bin/bash

## Clear Postgres data

rm -rf data/postgres/*

## Clear Rabbitmq data

rm -rf data/rabbitmq/*

## Clear Traccar data

rm -rf data/traccar/{logs,data,media}/*
