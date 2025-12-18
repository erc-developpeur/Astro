import React, { useRef } from "react";
import { Canvas, useFrame } from "@react-three/fiber";
import { EffectComposer, Noise } from "@react-three/postprocessing";
import * as THREE from "three";

const AnimatedPlane = () => {
    const meshRef = useRef();
    useFrame(() => {
        if (meshRef.current) {
            meshRef.current.material.uniforms.time.value += 0.01;
        }
    });

    return (
        <mesh ref={meshRef}>
            <planeGeometry args={[5, 5]} />
            <shaderMaterial
                uniforms={{
                    time: { value: 0 },
                    resolution: { value: new THREE.Vector2(window.innerWidth, window.innerHeight) }
                }}
                fragmentShader={`
                    uniform float time;
                    void main() {
                        vec2 uv = gl_FragCoord.xy / vec2(1920.0, 1080.0);
                        float dither = mod(uv.x * 10.0 + uv.y * 10.0 + time, 1.0);
                        gl_FragColor = vec4(vec3(dither), 1.0);
                    }
                `}
            />
        </mesh>
    );
};

const DitherBackground = () => {
    return (
        <Canvas>
            <AnimatedPlane />
            <EffectComposer>
                <Noise opacity={0.2} />
            </EffectComposer>
        </Canvas>
    );
};

export default DitherBackground;
