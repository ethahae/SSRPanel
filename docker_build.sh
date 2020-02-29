#!/bin/sh
docker build -t ryanw4ng/web:latest -f docker/Dockerfile .
docker build -t ryanw4ng/web:db -f docker/DBDockerfile sql
