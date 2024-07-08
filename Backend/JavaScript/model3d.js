import * as THREE from "https://cdn.skypack.dev/three@0.129.0/build/three.module.js";
import { OrbitControls } from "https://cdn.skypack.dev/three@0.129.0/examples/jsm/controls/OrbitControls.js";
import { GLTFLoader } from "https://cdn.skypack.dev/three@0.129.0/examples/jsm/loaders/GLTFLoader.js";

const scene = new THREE.Scene();
const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);

let object;
let startTime = null;
const rotationDuration = 1000;

const loader = new GLTFLoader();
loader.load(
  '/Frontend/3D/ibm_1401/scene.gltf',
  function (gltf) {
    object = gltf.scene;
    object.scale.set(2.5, 2.5, 2.5);

    object.position.set(0, -100, 0);

    scene.add(object);

    controls.target.set(0, 0, 0);

    startTime = performance.now();
  },
  function (xhr) {
    console.log((xhr.loaded / xhr.total * 100) + '% loaded');
  },
  function (error) {
    console.error(error);
  }
);

const renderer = new THREE.WebGLRenderer({ alpha: true });
renderer.setSize(window.innerWidth, window.innerHeight);

const container = document.getElementById("container3D");
container.appendChild(renderer.domElement);

camera.position.set(0, 0, 380);

const lights = [];
lights[0] = new THREE.DirectionalLight(0xffffff, 1);
lights[0].position.set(1, 1, 1);
scene.add(lights[0]);

lights[1] = new THREE.DirectionalLight(0xffffff, 0.5);
lights[1].position.set(-1, 1, -1);
scene.add(lights[1]);

lights[2] = new THREE.DirectionalLight(0xffffff, 0.5);
lights[2].position.set(-1, -1, 1);
scene.add(lights[2]);

lights[3] = new THREE.DirectionalLight(0xffffff, 0.5);
lights[3].position.set(1, -1, -1);
scene.add(lights[3]);

const ambientLight = new THREE.AmbientLight(0x333333, 1);
scene.add(ambientLight);

const controls = new OrbitControls(camera, renderer.domElement);

controls.target.set(0, 0, 0);

function animate(timestamp) {
  requestAnimationFrame(animate);

  if (object && startTime !== null) {
    const elapsed = timestamp - startTime;
    if (elapsed < rotationDuration) {
      const rotationSpeed = Math.PI / 6;
      object.rotation.y += rotationSpeed;
    }
  }

  controls.update();
  renderer.render(scene, camera);
}

window.addEventListener("resize", function () {
  camera.aspect = container.clientWidth / container.clientHeight;
  camera.updateProjectionMatrix();
  renderer.setSize(container.clientWidth, container.clientHeight);
});

animate();
